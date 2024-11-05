<script setup>
import {ref} from "vue";
import {products} from "../../../public/js/modules/models/Products.js";
import {categories} from "../../../public/js/modules/models/Categories.js";
import MainMenu from "@/Pages/Components/MainMenu.vue";
import ProductList from "@/Pages/Components/ProductList.vue";
import CategoriesList from "@/Pages/Components/CategoriesList.vue";
import TableList from "@/Pages/Components/TableList.vue";

let Menu = {
	items: [
		{
			id: 0,
			slug: "counter",
			active: true,
			text: "Counter",
			iconClass: ''
		},
		'separator',
		{
			id: 1,
			slug: "settings",
			active: false,
			text: "Settings",
			iconClass: ''
		}
	],
	setActive: function (id) {
		console.log(this)
		for (let item of this.items) {
		    if (item == "separator") continue;
		    item.active = item.id === id;
		}
	},
	getActiveMenu: function (){
		for (let item of this.items) {
			if (item == "separator") continue;
			if (item.active) return item
		}
	}
}
function setActiveMenu(id) {
	Menu.setActive(id)
}

const productList= ref([]);
products.get().then((products)=>productList.value=products.values())
const categoriesList= ref([]);
categories.get().then((categories)=>categoriesList.value=categories.values())

</script>

<template>
    <MainMenu :menuItems="Menu.items" @menuClick="setActiveMenu"/>
	<main>
		<section >
			<CategoriesList :categoriesList/>
			<ProductList v-if="Menu.getActiveMenu().slug==='counter'" :productList/>
		</section>
		<section>
			<TableList/>
		</section>
	</main>
</template>

<style>
section {
	border: 1px solid black;
	margin : 0.5rem;
}
</style>
