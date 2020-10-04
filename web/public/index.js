let tasks = new Tasks();
tasks.init();
//let paginations = document.getElementsByClassName('pagination-button');
//let cards = document.getElementById('cards-task');



//getURLGet();
// if(typeof page === 'undefined'){ 
//     current = document.getElementsByClassName('current-page')[0];
//     current.classList.add('active');
// }else{
//     current = document.getElementById('pagination-'+page);
//     current.classList.add('active');
// }

// async function changePage(){ 
//     if(current === this){
//         return;
//     }

//     if(current !==null){ 
//         current.classList.remove('active');
//     }
    
//     this.classList.add('active');
//     current = this;
//     cards.innerHTML='';
//     let url = '/tasks?page='+this.dataset.id;
//     page=this.dataset.id;
//     setURL();
//     let response = await fetch(url);

//     if (response.ok) { 
//     let json = await response.json();

//     changeElements(json);
//     } else {
//     console.log("Error: " + response.status);
//     }
// }

// function changeElements(data){
//     for (let i = 0; i < data.length; i++) {
//         let completed = (data[i]['completed'] === '0')? '&#10060;' : '&#9989;';
//         let html = `
//         <div class="card border-dark mt-4 card-task">
//             <div class="card-header">
//                 <div>`+completed+`</div>
//                 <div>`+data[i]['username']+`</div>
//             </div>
//             <div class="card-body text-dark">
//                 <h5 class="card-title">`+data[i]['email']+`</h5>
//                 <p class="card-text">`+data[i]['text']+`</p>
//             </div>
//         </div>`;
//         cards.insertAdjacentHTML('beforeend',html);
//     }
// }

// function setURL(){
//     let urlGet='';
//     let getSort='';
//     let getPage='';
//     if(typeof page !== 'undefined' || typeof sort !== 'undefined'){
//         urlGet+='?';
//         if(typeof sort !== 'undefined'){
//             getSort='&sort='+sort;
//         }else if(typeof page !== 'undefined'){
//             getPage='page='+page;
//         }
//         urlGet=urlGet+getPage+getSort;
//     }
//     let url = window.location.pathname+urlGet;
//     window.history.replaceState('','',urlGet);
// }

// function getURLGet(){
//     let sortArr=['username','email','complated'];
//     let result=window.location.search.match(/(page=[0-9]+|sort=[a-z]+)/g);
//     if(result!=null){
//         for(let i = 0; i < result.length; i++){
//             if(result[i].indexOf('page')!=-1){
//                 page = Number(result[i].match(/[0-9]+/));
//             } else if(result[i].indexOf('sort')!=-1){
//                 for(let j = 0; j < sortArr.length; j++){
//                     if(result[i].indexOf(sortArr[j])!=-1){
//                         sort=sortArr[j];
//                         break;
//                     }
//                 }
//             }
//         }
//     }
// }
async function changePage(){ 
    if(tasks.current === this){
        return;
    }

    if(tasks.current !==null){ 
        tasks.current.classList.remove('active');
    }
    let url;
    this.classList.add('active');
    tasks.current = this;
    tasks.cards.innerHTML='';
    url = '/tasks?page='+this.dataset.id;
    tasks.page=this.dataset.id;
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
    this.current=null;
    this.sort='';
    this.page=-1;
    this.paginations= null;
    this.cards=null;
    this.sortArr=['username','email','complated'];

    this.init=function(){
        this.initCards();
        this.initPaginationButtons();
        this.getURLGET();
        this.initCurrentPage();
    };

    this.initPaginationButtons=function(){
        this.paginations = document.getElementsByClassName('pagination-button');
        for (let i = 0; i < this.paginations.length; i++) {
            this.paginations[i].onclick = changePage;
        }
    };
    this.initCards=function(){
        this.cards = document.getElementById('cards-task');
    };
    this.initCurrentPage=function(){
        if(this.page === -1){ 
            this.current = document.getElementsByClassName('current-page')[0];
            this.current.classList.add('active');
        }else{
            this.current = document.getElementById('pagination-'+this.page);
            this.current.classList.add('active');
        }
    };
    
    this.changeElements=function(data){
        for (let i = 0; i < data.length; i++) {
            let completed = (data[i]['completed'] === '0')? '&#10060;' : '&#9989;';
            let html = `
            <div class="card border-dark mt-4 card-task">
                <div class="card-header">
                    <div>`+completed+`</div>
                    <div>`+data[i]['username']+`</div>
                </div>
                <div class="card-body text-dark">
                    <h5 class="card-title">`+data[i]['email']+`</h5>
                    <p class="card-text">`+data[i]['text']+`</p>
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
                            this.sort=sortArr[j];
                            break;
                        }
                    }
                }
            }
        }
    };
    this.setURL=function(){
        let urlGet='';
        let getSort='';
        let getPage='';
        if(typeof page !== -1 || typeof this.sort !== ''){
            urlGet+='?';
            if(this.sort !== ''){
                getSort='&sort='+this.sort;
            }else if(this.page !== -1){
                getPage='page='+this.page;
            }
            urlGet=urlGet+getPage+getSort;
        }
        let url = window.location.pathname+urlGet;
        window.history.replaceState('','',url);
    };
    
}