
/*jshint esversion: 6 */

const express = require("express");
const bodyparser = require("body-parser");
const app = express();
const mongoose = require("mongoose");

const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var today = new Date();

app.set('view engine', 'ejs');
app.use(bodyparser.urlencoded({extended:true}));
app.use(express.static("public"));
mongoose.connect("mongodb://localhost: 27017/notesDB", { useNewUrlParser: true });

const noteSchema = {name : String};
const Note =  mongoose.model("Note", noteSchema);

const note1 = new Note({name : "Hit the checkbox to delete"});
const note2 = new Note({name : "Hit + to submit the Note"});

app.get("/",function(req,res){

  Note.find({},function(error, foundItems){
    if(foundItems === 0)
    {
      Note.insertMany([note1,note2],function(err){
        if(err)
        console.log(err);
        else
        console.log("successfully inserted");
      });
    }
      res.render("list",{kindOfDay : days[today.getDay()],notesList: foundItems});
  }
);

});

app.post("/delete",function(req,res){
  console.log(req.body.checkBox);
  Note.findByIdAndRemove(req.body.checkBox, function (err, docs) {
     if (err){
         console.log(err);
     }
     else{
         console.log("Note deleted"); res.redirect("/");
     }
 });

});
app.listen(3000,function(){
  console.log("server started");
});

app.post("/",function(req,res)
{
  const note = new Note({
    name : req.body.newNote
  })
  note.save();
  res.redirect("/");
});
