import { useState } from 'react';
import './App.css';

function App() {

  const [nom, setNom ] = useState("titi");

  const handleClick = () => {
    console.log("click")
    setNom("tutu");
  }

  const handleChange = (event) => {
    console.log("change")
    setNom(event.target.value);
  }

  return (
    <>
      <div>
          {nom}
          <br />
          <input type="text" value={nom} onChange={handleChange}/>
      </div>
      <button onClick={handleClick}>Clique moi !!!</button>
    </>
  );
}

export default App;
