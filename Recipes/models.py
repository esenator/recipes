from Recipes import db

class User(db.Model):
    username = db.Column(db.String(16), index=True, unique=True, primary_key=True)
    email = db.Column(db.String(64), index=True, unique=True)
    firstname = db.Column(db.String(16))
    lastname = db.Column(db.String(16))
    password = db.Column(db.String(160))
    
    def is_authenticated(self):
        return True
    
    def is_active(self):
        return True

    def is_anonymous(self):
        return False

    def get_id(self):
        try:
            return unicode(self.id)  # python 2
        except NameError:
            return str(self.id)  # python 3

    def __repr__(self):
        return '<User %r>' % (self.username)

    