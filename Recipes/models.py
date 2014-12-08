from Recipes import db

class User(db.Model):
    __tablename__ = 'User'
    username = db.Column(db.String(16), index=True, unique=True, primary_key=True)
    email = db.Column(db.String(64), index=True, unique=True)
    firstname = db.Column(db.String(16))
    lastname = db.Column(db.String(16))
    password = db.Column(db.String(160))
    bio = db.Column(db.String(1000))
    recipes = db.relationship('Recipe', backref='authorref')
    
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

class Unit(db.Model):
    __tablename__ = 'Unit'
    id = db.Column(db.Integer, primary_key=True)
    unit = db.Column(db.String(16), index=True)
    def __repr__(self):
        return '<Unit %r>' % (self.unit)

class Recipe(db.Model):
    __tablename__ = 'Recipe'
    id = db.Column(db.Integer, primary_key=True, unique=True)
    name = db.Column(db.String(64), index=True)
    author = db.Column(db.String(16), db.ForeignKey('User.username'))
    parent = db.Column(db.String(64), index=True)
    timestamp = db.Column(db.DateTime)
    steps = db.Column(db.String(10000))
    children = db.relationship("RecipeToIngredient", backref="recipe")

    def __repr__(self):
        return '<Recipe %r>' % (self.name)

class Ingredient(db.Model):
    __tablename__ = 'Ingredient'
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(40), index=True)
    is_allergen = db.Column(db.Boolean)

    def __repr__(self):
        return '<Ingredient %r>' % (self.name)
    
class RecipeToIngredient(db.Model):
    __tablename__ = 'RecipeToIngredient'
    recipeid = db.Column(db.Integer, db.ForeignKey('Recipe.id'), primary_key=True)
    ingredientid = db.Column(db.Integer, db.ForeignKey('Ingredient.id'), primary_key=True)
    unitid = db.Column(db.Integer, db.ForeignKey('Unit.id'))
    unit = db.relationship("Unit")
    quantity = db.Column(db.String(10))
    ingredient = db.relationship("Ingredient", backref="rectoingred")





