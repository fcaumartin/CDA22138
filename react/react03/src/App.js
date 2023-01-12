import { useState } from "react";
import axios from "axios";

function App() {

  const [search, setSearch] = useState("");
  const [tableau, setTableau] = useState([]);

  const handleClick = () => {

    axios
      .get("http://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=" + search)
      .then( (reponse) => { 
        console.log(reponse.data.results)
        setTableau(reponse.data.results)
      })

    console.log(search);
  }

  return (
    <>
      <div>
        <input type="text" value={search} onChange={ (event) => { setSearch(event.target.value)} } />
        <button onClick={handleClick}>Rechercher</button>
      </div>
      <div>
        {
          tableau.map((film)=>(
            <div>
              {film.title}
              <br />
              <img src={"https://image.tmdb.org/t/p/w185" + film.poster_path} alt="" />
            </div>
          ))
        }
      </div>
    </>
  );
}

export default App;



