export class Project {
    constructor (name, description, picture, link, date)
    {
        this.name = name;    
        this.description = description;
        this.picture = picture;
        this.link = link;
        this.date = new Date(date);    
    }

    gen_card(x)
    {
        let add_section = document.getElementById('blocHorizontal'),
            a = document.createElement('a'),
            h2 = document.createElement('h2'),
            img = document.createElement('img');

        a.href = this.link;
        a.className = 'slide ' + ((x++ % 2)? 'two' : 'one');

        h2.innerHTML = this.name;

        img.src = this.picture;
        img.alt = this.name;

        a.append(h2, img);

        add_section.appendChild(a);
    }

    gen_new_project()
    {
        let add_section = document.getElementById('new_prods'),
            a = document.createElement('a'),
            h2 = document.createElement('h2'),
            img = document.createElement('img');

        a.href = this.link;

        h2.innerHTML = this.name;

        img.src = this.picture;
        img.alt = this.name;

        a.append(h2, img);

        add_section.appendChild(a);
    }
}