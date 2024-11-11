import {Endpoint} from "./Endpoints.js";
export class Model extends Endpoint {
	#classname = this.constructor.name.replace("_","/").toLowerCase();
	#url = document.location.origin+"/api/"+this.#classname;
	source = {};
	values(){
		return Object.values(this.source)
	}
	async get(id=null,suffix=null) {
		let url = this.#url;
		if (suffix!=null) url += suffix;
		url = (id==null)?url:url+"/"+id
		let response = await fetch(url);
		let json = await response.json();
		this.source = json.data
		return this
	}
}

export let model = new Model()
