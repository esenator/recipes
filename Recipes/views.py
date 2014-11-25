"""
Routes and views for the flask application.
"""
from flask import render_template, flash, redirect, session, url_for, request, g, jsonify
from flask.ext.login import login_user, logout_user, current_user, login_required
from Recipes import app, db, lm
from .forms import LoginForm, RegisterForm, EditProfileForm, DeleteProfileForm
from .models import User, Ingredient, Unit
from werkzeug.security import generate_password_hash, check_password_hash

@app.route('/dbcreate')
def createdb():
    db.create_all()

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
            flash(str("Login failed, please try again"))
            return render_template("error.html")
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
    
    if form.validate_on_submit():
        session['remember_me'] = form.remember_me.data
        password = generate_password_hash(form.password.data)
        try:
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
        except Exception as e:
            flash(str(e))
            return render_template("error.html")
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

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/recipes')
def recipes():
    return render_template('recipes.html')

@app.route("/editprofile", methods=["GET", "POST"])
def editprofile():
    if g.user is None and not g.user.is_authenticated():
        return redirect(url_for('index'))
    form = EditProfileForm()
    
    if form.validate_on_submit():
        try:
            email = User.query.filter_by(email = form.email.data).first()
            if email is None:     
                if form.email.data != "": 
                    g.user.email = form.email.data
                first = form.firstname.data
                last = form.lastname.data

                if first != "": 
                    g.user.firstname = first
                    db.session.commit()

                if last != "": 
                    g.user.lastname = last
                    db.session.commit()

                db.session.commit()
                flash('Thanks for editing your profile!')
            else: 
                flash('Email already in use, please enter new one')
                
            return redirect(request.args.get('next') or url_for('index'))
        except Exception as e:
            flash(str(e))
            return render_template("error.html")
    return render_template('editprofile.html', form=form)

@app.route('/delete', methods =["GET", "POST"])
def delete(): 
    if g.user is None and not g.user.is_authenticated():
            return redirect(url_for('index'))
    form = DeleteProfileForm()

    if form.validate_on_submit(): 
        try: 
            user = User.query.filter_by(username = form.username.data).first()
            if user is not None: 
                if check_password_hash(user.password, form.password.data):
                    db.session.delete(user)
                    db.session.commit()
            return redirect(url_for('index'))

        except Exception as e: 
            flash(str(e))
            return render_template("error.html")
    return render_template('delete.html', form=form)


@app.route('/recipes/<number>')
def recipefinder(number):
    number = int(number)
    if number == 0:
        return jsonify({'name':"Spaghetti", 'steps':"Put the pasta in the belly."})
    if number == 1:
        return jsonify({'name':"Tortellini", 'steps':"Put the pasta in the oven."})
    if number == 2:
        return jsonify({'name':"Linguini", 'steps':"Boil water and put pasta in."})
    if number == 3:
        return jsonify({'name':"Nachos", 'steps':"Melt cheese over chips."})
    if number == 4:
        return jsonify({'name':"Quesadilla", 'steps':"grill cheese in a tortilla."})
    else:
        return jsonify({'name':"Potato", 'steps':"Eat it!"})

@app.route('/newrecipe')
def newRecipe(): 
    user = g.user
    return render_template('newrecipe.html')

@app.route('/ingredNames')
def getIngredName(): 
    ingred = Ingredient.query.with_entities(Ingredient.name).all()
    ingred2 = []
    for i in ingred:
        ingred2.append(i[0])
    return jsonify(names=ingred2)

@app.route('/ingredUnits')
def getIName(): 
    ingred = Ingredient.query.with_entities(Unit.unit).all()
    ingred2 = []
    for i in ingred:
        ingred2.append(i[0])
    return jsonify(names=ingred2)

@app.route('/bio')
def bio():
    return render_template('bio.html')
