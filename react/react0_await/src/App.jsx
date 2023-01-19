import { useEffect, useState } from "react";
import { test5 } from "./lib";


function App() {

	const [liste, setListe] = useState([]);

	useEffect(() => {

		async function start() {

			// console.log("000");
			let tmp = await test5();
			// console.log(tmp);
			;
			// await tmp.then((data) => {
			setListe(tmp);
			// 	console.log("333");
			// })
			// console.log("444");
		} 
		start();
	}, [])

	return (
		<div>
			Demo
			{
				liste.map((elt, i) => (
					<div key={i}>
						{elt.title}
					</div>
				))
			}
		</div>
	);
}

export default App;
