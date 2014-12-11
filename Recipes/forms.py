from flask.ext.wtf import Form
from wtforms import BooleanField, TextField, PasswordField, validators
from wtforms.validators import DataRequired

class RegisterForm(Form):
    username = TextField('Username')
    email = TextField('Email Address')
    password = PasswordField('Password', [
        validators.Required()])
    firstname = TextField('First name')
    lastname = TextField('Last name')
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
    bio = TextField('Bio')
    
class DeleteProfileForm(Form): 
    username = TextField('Username', [validators.Required()])
    password = PasswordField('password', [validators.Required()])
  