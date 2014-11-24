"""
The flask application package.
"""

from flask import Flask
from flask_bootstrap import Bootstrap
from flask.ext.sqlalchemy import SQLAlchemy
from flask.ext.login import LoginManager

app = Flask(__name__)

try:
    app.config.from_object('config')
except:
    app.config.from_pyfile('../config.py')

db = SQLAlchemy(app)

lm = LoginManager()
lm.init_app(app)
lm.login_view = 'login'

Bootstrap(app)

from Recipes import views, models
