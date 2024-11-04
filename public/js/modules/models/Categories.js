import {Endpoint} from "../Endpoints.js";
class Categories extends Endpoint {
    #url = "http://127.0.0.1:8000/api/categories";
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

export const categories = new Categories();
