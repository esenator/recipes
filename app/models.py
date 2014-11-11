from app import db

class User(db.Model):
    username = db.Column(db.String(16), index=True, unique=True, primary_key=True)
    email = db.Column(db.String(120), index=True, unique=True)
    firstname = db.Column(db.String(16))
    lastname = db.Column(db.String(16))
    password = db.Column(db.String(160))
    

    def __repr__(self):
        return '<User %r>' % (self.username)