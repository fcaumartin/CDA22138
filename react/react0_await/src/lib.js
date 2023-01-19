import axios from "axios"


function test1() {
    console.log("111");
    axios.get("http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=avenger").then((response)=>{
        console.log("222");
    });
    console.log("333");
}

async function test2() {
    let resultat = [];
    await axios.get("http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=avenger").then((response)=>{
        resultat = response.data.results;
    });
    
    return resultat;
}

async function test3() {
    console.log("111");
    await axios.get("http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=avenger").then((response)=>{
        console.log("222");
    });
    console.log("333");
}

async function test4() {
    let resultat = [];
    let aa = await axios.get("http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=avenger").then((response)=>{
        resultat = response.data.results;
    });
    console.log(resultat);
    return await aa;
}

async function test5() {
    console.log("111");
    const res = await axios.get("http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=avenger");
    // const { data } = await res;
    console.log(res.data.results);
    console.log("222");
    return res.data.results;
}




export {test1, test2, test3, test4, test5}