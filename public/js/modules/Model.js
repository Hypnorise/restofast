import {Endpoint} from "./Endpoints.js";
export class Model extends Endpoint {
	#classname = this.constructor.name.toLowerCase();
	#url = document.location.origin+"/api/"+this.#classname;
	source = {};
	entries(){
		return Object.entries(this.source)
	}
	values(){
		return Object.values(this.source)
	}
	async get(id=null) {
		let url = (id==null)?this.#url:this.#url+"/"+id
		let response = await fetch(url);
		let json = await response.json();
		this.source = json.data
		return this
	}
}

export let model = new Model()
