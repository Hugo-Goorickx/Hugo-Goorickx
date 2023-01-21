import { Project } from './Project.js';
import file from '../projects.json' assert {type: 'json'};

let x = 0,
    Projects = [];

function modif()
{
    let div1 = document.getElementsByClassName('new_prods')[0],
        div2 = document.getElementsByClassName('global_corp')[0],
        div3 = document.getElementsByClassName('container')[0];
    if (div1.style.display == 'block')
    {
        div1.style.display = 'none';
        div2.style.filter = 'blur(0rem)';
        div3.style.filter = 'blur(0rem)';
    }
    else
    {
        div1.style.display = 'block';
        div2.style.filter = 'blur(1.5rem)';
        div3.style.filter = 'blur(1.5rem)';
    }
}
document.getElementById('modif').addEventListener("click", function() {modif();});
document.getElementById('blocHorizontal').style.width = (file.projects.length + "00vw");

file.projects.forEach(elem => Projects.push(new Project(elem.name, elem.description, elem.picture, elem.link, elem.date)));

Projects.sort((a,b) => { return (a.date>b.date)?-1:1; });

Projects.forEach(elem => elem.gen_card(x++));

for (let index = 0; index < 3; index++)
    Projects[index].gen_new_project(index);