"""
Routes and views for the flask application.
"""
from flask import render_template, flash, redirect, session, url_for, request, g
from flask.ext.login import login_user, logout_user, current_user, login_required
from Recipes import app, db, lm
from .forms import LoginForm, RegisterForm
from .models import User
from werkzeug.security import generate_password_hash, check_password_hash

@app.route('/')
@app.route('/index')
@login_required
def index(): 
    user = g.user
    return render_template('index.html', user=user, title='Home')

@app.route('/temp')
def temp(): 
	return render_template('temp.html')

@lm.user_loader
def load_user(id):
    return User.query.get(id)

@app.route("/login", methods=["GET", "POST"])
def login():
    if g.user is not None and g.user.is_authenticated():
        return redirect(url_for('index'))
    form = LoginForm()
    #Query database
    if form.validate_on_submit():
        session['remember_me'] = form.remember_me.data
        try:
            user = User.query.filter_by(username = form.username.data).first()
            if not check_password_hash(user.password, form.password.data):
                user = None
            remember_me = form.remember_me.data
        except Exception as e:
            flash(str(e))
            return render_template("index.html")
        if user is not None:
            if remember_me is not None:
                login_user(user, remember = remember_me)
            else: 
                login_user(user)
            return redirect(request.args.get("next") or url_for("index"))
        else:
            return render_template("login.html", form=form)
    return render_template("login.html", form=form)

@app.route("/logout")
@login_required
def logout():
    logout_user()
    return redirect(url_for('index'))

@app.route("/register", methods=["GET", "POST"])
def register():
    if g.user is not None and g.user.is_authenticated():
        return redirect(url_for('index'))
    form = RegisterForm()
    session['remember_me'] = form.remember_me.data
    if request.method == 'POST' and form.validate():
        password = generate_password_hash(form.password.data)
        user = User.query.filter_by(username = form.username.data).first()
        if user is None:
            user = User(username=form.username.data, email=form.email.data,
                    password=password, firstname=form.firstname.data, lastname=form.lastname.data)
            db.session.add(user)
            db.session.commit()
            remember_me = False
            if 'remember_me' in session:
                remember_me = session['remember_me']
                session.pop('remember_me', None)
            login_user(user, remember = remember_me)
            flash('Thanks for registering')
        return redirect(request.args.get('next') or url_for('index'))
    return render_template('register.html', form=form)

@app.before_request
def before_request():
    g.user = current_user

@app.route('/user/<username>')
@login_required
def user(username):
    user = User.query.filter_by(username=username).first()
    if user == None:
        flash('User %s not found.' % username)
        return redirect(url_for('index'))
    return render_template('user.html', user=user)

@app.route('/contact')
def contact():
    return render_template('contact.html')

