from flask.ext.wtf import Form
from wtforms import BooleanField, TextField, PasswordField, validators
from wtforms.validators import DataRequired

class RegisterForm(Form):
    username = TextField('Username', [validators.Length(min=6, max=16)])
    email = TextField('Email Address', [validators.Length(min=6, max=64)])
    password = PasswordField('Password', [
        validators.Required(),
        validators.EqualTo('confirm', message='Passwords must match')
    ])
    confirm = PasswordField('Repeat Password')
    firstname = TextField('First name')
    lastname = TextField('Last tname')
    remember_me = BooleanField('remember_me', default=False)
    
class LoginForm(Form):
    username = TextField('Username', [validators.Length(min=6, max=16)])
    password = PasswordField('Password', [
        validators.Required()
    ])
    remember_me = BooleanField('remember_me', default=False)

class EditProfileForm(Form): 
    firstname = TextField('First name', [validators.Length(min=0, max = 20)])
    lastname = TextField('Last name', [validators.Length(min=0, max = 20)])
    email = TextField('Email')
    
class DeleteProfileForm(Form): 
    username = TextField('Username', [validators.Required()])
    password = PasswordField('password', [validators.Required()])
  