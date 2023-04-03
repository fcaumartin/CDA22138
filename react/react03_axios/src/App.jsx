import { useState } from "react";
import axios from "axios";
import DataTable from "react-data-table-component";


const columns = [
  {
    name: <b>Colonne 1</b>,
    selector: (row) => row.id,
    sortable: true,
  },
  {
    name: <b>Colonne 2</b>,
    selector: (row) => row.password,
    sortable: true,
  },
  {
    name: <b>Colonne 3</b>,
    selector: (row) => row.roles,
    sortable: true,
  }
];

function App() {

  const [tableau, setTableau] = useState([]);

  const handleClick1 = () => {

    axios
      .post(
        "http://frc.amorce.org/api/login_check",
        {
          "username": "admin",
          "password": "1234"
        },
        {
          headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
          }
        })
      .then( (reponse) => { 
        console.log(reponse.data.token)
        window.token = reponse.data.token
      })

  }

  const handleClick2 = () => {

    axios
      .get(
        "http://frc.amorce.org/api/produits",
        {
          headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + window.token,
            "Content-Type": "application/json",
            "x-toto": "toto"
          }
        })
      .then( (reponse) => { 
        console.log(reponse.data)
        setTableau(reponse.data)
      })

  }

  return (
    <>
      <div>
        <button onClick={handleClick1}>login_check</button>
        <button onClick={handleClick2}>users</button>
      </div>
      <div>
        <DataTable
          columns={columns}
          data={tableau}
          defaultSortFieldId={1}
        />
      </div>
    </>
  );
}

export default App;



