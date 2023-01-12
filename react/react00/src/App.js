import { useState } from "react";

function App() {

  const [nom, setNom] = useState("toto")
  const [prenom, setPrenom] = useState("toto")

  const handleChangeNom = (event) => {
    setNom(event.target.value)
  }

  const handleChangePrenom = (event) => {
    setPrenom(event.target.value)
  }

  return (
    <>
      
      <div>
        <input 
          type="text" 
          value={nom} 
          onChange={ (event) => { handleChangeNom(event) }}
        />
      </div>
      <div>
        <input type="text" value={prenom} onChange={handleChangePrenom}/>
      </div>
      <div>
        Bonjour {prenom} {nom}
      </div>
    </>
  );
}

export default App;
