from flask import Flask
from flask.ext.sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config.from_object('config')
db = SQLAlchemy(app)

from flask_bootstrap import Bootstrap
Bootstrap(app)

from app import views, models
