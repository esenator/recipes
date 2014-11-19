from Recipes import db

class User(db.Model):
    username = db.Column(db.String(16), index=True, unique=True, primary_key=True)
    email = db.Column(db.String(64), index=True, unique=True)
    firstname = db.Column(db.String(16))
    lastname = db.Column(db.String(16))
    password = db.Column(db.String(160))
    recipes = db.relationship('Recipe', backref='author', lazy='dynamic')
    
    def is_authenticated(self):
        return True
    
    def is_active(self):
        return True

    def is_anonymous(self):
        return False

    def get_id(self):
        try:
            return unicode(self.username)  # python 2
        except NameError:
            return str(self.username)  # python 3

    def __repr__(self):
        return '<User %r>' % (self.username)

class Recipe(db.Model):
    id = db.Column(db.Integer, primary_key=True, unique=True)
    name = db.Column(db.String(64), index=True)
    user_id = db.Column(db.String(16), db.ForeignKey('user.username'))
    parent = db.Column(db.String(64), index=True)
    timestamp = db.Column(db.DateTime)
    
    def __repr__(self):
        return '<Recipe %r>' % (self.name)
    