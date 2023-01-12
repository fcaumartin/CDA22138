import { useState } from "react";

function App() {

  const [ compteur, setCompteur] = useState(0);

  const handleClick = () => {
      setCompteur(compteur+1);
  }

  return (
      <div>
        {compteur}
        <br />
        <button onClick={handleClick}>Clique moi !</button>
      </div>
  );
}

export default App;
