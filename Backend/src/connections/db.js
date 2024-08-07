const mysql = require('mysql');
const dotenv = require("dotenv");
dotenv.config();
const db = mysql.createConnection({
    host: process.env.DATABASE_HOST,
    user: process.env.DATABASE_USER,
    password: process.env.DATABASE_PASSWORD,
    database : process.env.DATABASE
});

db.connect(function(err){
    if(err) throw err;
    console.log("Database Connected.");
});

module.exports = db;