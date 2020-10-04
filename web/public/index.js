let tasks = new Tasks();
tasks.init();

async function changePage(){ 
    if(tasks.current === this){
        return;
    }

    let url;
    let page;
    let sort;
    //this.classList.add('active');
    //tasks.current = this;
    tasks.cards.innerHTML='';
    if(this.dataset.type === 'page'){
        page =this.dataset.id;
        sort =tasks.sort;
        tasks.changePaginationButton(this);
    }else if(this.dataset.type === 'sort'){
        page=tasks.page;
        sort=this.dataset.name;
        tasks.changeSortButton(this);
    }
    url = tasks.url + '?page=' +page+'&sort='+sort+'&asc='+tasks.asc;
    tasks.setURL();
    let response = await fetch(url);
    if (response.ok) { 
    let json = await response.json();
    tasks.changeElements(json);
    } else {
    console.log("Error: " + response.status);
    }
};

function Tasks(){
    this.asc='true';
    this.current=null;
    this.currentSort=null;
    this.sort='id';
    this.page=1;
    this.paginations= null;
    this.sortButtons = null;
    this.cards=null;
    this.sortArr=['username','email','complated'];
    this.url='/tasks';
    this.update = false;

    this.init=function(){
        this.initCards();
        this.initPaginationButtons();
        this.initSortButtons();
        this.getURLGET();
        this.initCurrentPage();
        this.checkUpdate();
        
    };

    this.initPaginationButtons=function(){
        this.paginations = document.getElementsByClassName('pagination-button');
        for (let i = 0; i < this.paginations.length; i++) {
            this.paginations[i].onclick = changePage;
        }
    };
    this.initSortButtons=function(){
        this.sortButtons = document.getElementsByClassName('sort-button');
        for (let i = 0; i < this.sortButtons.length; i++) {
            this.sortButtons[i].onclick = changePage;
        }
    };
    this.initCards=function(){
        this.cards = document.getElementById('cards-task');
    };
    this.initCurrentPage=function(){
        this.current = document.getElementById('pagination-'+this.page);
        if(this.current != null){
            this.current.classList.add('active');
        }
        
    };
    this.checkUpdate=function(){
        let update = document.getElementsByClassName('update-button');
        console.log(update);
        if(update.length===0){
            this.update = false;
        }else{
            this.update = true;
        }
    };

    this.changePaginationButton = function(elem){
        this.page=elem.dataset.id;
        if(this.current !==null){ 
            this.current.classList.remove('active');
        }
        elem.classList.add('active');
        this.current = elem;
    };

    this.changeSortButton = function(elem){
        if(!elem.hasAttribute('data-asc')){ 
            elem.setAttribute('data-asc', 'true');
            if(this.currentSort != null){
                this.currentSort.lastChild.innerHTML = '';
            }
            this.currentSort = elem;
            this.asc = 'true';
            elem.lastChild.innerHTML = '&uarr;';
        }else if(elem === this.currentSort){ 
            if(elem.dataset.asc == 'true'){
                elem.dataset.asc ='false';
                this.asc = 'false';
                elem.lastChild.innerHTML = '&darr;';
            }else{
                elem.dataset.asc='true';
                this.asc = 'true';
                elem.lastChild.innerHTML = '&uarr;';
            }
        }else{
            this.currentSort.lastChild.innerHTML = '';
            this.currentSort.dataset.asc = 'true';
            this.currentSort = elem;
            this.asc = 'true';
            this.currentSort.lastChild.innerHTML = '&uarr;';
        }

        this.sort=elem.dataset.name;
        this.currentSort = elem;
    };
    
    this.changeElements=function(data){
        for (let i = 0; i < data.length; i++) {
            let completed = (data[i]['completed'] === '0')? '&#10060;' : '&#9989;';
            let updateButton;
            if(this.update){
                updateButton = '<a class="btn btn-warning update-button" href="/update?id='+data[i]['id']+'">Update</a>';
            }
            let html = `
            <div class="card border-dark mt-4 card-task">
                <div class="card-header">
                    <span>`+completed+`</span>
                    <span>`+data[i]['username']+`</span>
                </div>
                <div class="card-body text-dark">
                    <h5 class="card-title">`+data[i]['email']+`</h5>
                    <p class="card-text">`+data[i]['text']+`</p>
                    `+updateButton+`
                </div>
            </div>`;
            this.cards.insertAdjacentHTML('beforeend',html);
        }
    };
    this.getURLGET=function(){
        let result=window.location.search.match(/(page=[0-9]+|sort=[a-z]+)/g);
        if(result!=null){
            for(let i = 0; i < result.length; i++){
                if(result[i].indexOf('page')!=-1){
                    this.page = Number(result[i].match(/[0-9]+/));
                } else if(result[i].indexOf('sort')!=-1){
                    for(let j = 0; j < this.sortArr.length; j++){
                        if(result[i].indexOf(this.sortArr[j])!=-1){
                            this.sort=this.sortArr[j];
                            break;
                        }
                    }
                }
            }
        }
    };
    this.setURL=function(){
        let urlGet='?';
        let getSort='&sort='+this.sort;
        let getPage='page='+this.page;
        urlGet='?page='+this.page+'&sort='+this.sort+'&asc='+this.asc;
        let url = window.location.pathname+urlGet;
        window.history.replaceState('','',url);
    };
    
}