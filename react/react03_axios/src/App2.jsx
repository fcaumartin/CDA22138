import { useState } from "react";
import axios from "axios";
import DataTable from "react-data-table-component";


const columns = [
  {
    name: <b>Titre</b>,
    selector: (row) => row.title,
    sortable: true,
  },
  {
    name: <b>Image</b>,
    selector: (row) => row.poster_path,
    sortable: true,
  },
  {
    name: <b>Organisme</b>,
    selector: (row) => row.title,
    sortable: true,
  }
];

function App2() {

  const [data, setData] = useState([
    { nom: "", prenom: "", ville: "" },
    { nom: "", prenom: "", ville: "" },
    { nom: "", prenom: "", ville: "" },
    { nom: "", prenom: "", ville: "" },
  ]);

  return (
    <>
        <DataTable
          columns={columns}
          data={tableau}
          defaultSortFieldId={1}
        />
    </>
  );
}

export default App2;



