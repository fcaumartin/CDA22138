import { useState } from "react";

function App() {

  const [data, setData] = useState("");

  const [tableau, setTableau] = useState(["toto", "titi", "tutu"]);

  const handleClick = () => {

      // var tmp = [ ...tableau ];
      // tmp.push(data);
      // setTableau(tmp);

      setTableau([ ...tableau, data ])
  }

  return (
    <>
      <div>
        <input 
          type="text" 
          value={data} 
          onChange={ (event) => { setData(event.target.value) } }
        />
      </div>
      <button onClick={handleClick}>Ajouter</button>
      <div>
        {
          tableau.map( (element, i) => (
            <div key={i}>
              {element}
            </div>
          ))
        }
      </div>
    </>
  );
}

export default App;
