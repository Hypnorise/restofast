<script setup>
import {ref} from "vue";
import {products} from "../../../public/js/modules/models/Products.js";
import {categories} from "../../../public/js/modules/models/Categories.js";
import {tables} from "../../../public/js/modules/models/Tables.js"
import {Model} from "../../../public/js/modules/Model.js";
import Menu from "@/Pages/Components/MainMenu.vue";
import TableList from "@/Pages/Components/TableList.vue";
import AddOrder from "@/Pages/AddOrder.vue";

let MainMenu = {
	items: ref([
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
	]),
	setActive: function (id) {
		for (let item of this.items.value) {
			if (item == "separator") continue;
			item.active = item.id === id;
		}
	},
	getActiveMenu: function () {
		for (let item of this.items.value) {
			if (item == "separator") continue;
			if (item.active) return item
		}
	}
}
function setActiveMenu(id) {
	MainMenu.setActive(id)
}


const productList = ref([]);
products.get().then((products) => productList.value = products.values())
const categoryList = ref([]);
categories.get().then((categories) => categoryList.value = categories.values())
const tableList = ref([]);
tables.get().then((tables) => tableList.value = tables.values())
class Tables_withOrders extends Model {
}
let tables_withOrders = new Tables_withOrders;
const tablesWithOrders = ref([]);
tables_withOrders.get(null).then((tables) => tablesWithOrders.value = tables.values())

</script>

<template>
	<Menu :menuItems="MainMenu.items.value" @menuClick="setActiveMenu"/>
	<main v-if="MainMenu.getActiveMenu().slug==='counter'">
		<section>
			<CategoryList :categoryList/>
		</section>
		<section>
			<TableList :table-list="tablesWithOrders"/>
		</section>
		<section>
			<AddOrder :productList :categoryList/>
		</section>
	</main>
</template>

<style>
section {
	border : 1px solid black;
	margin : 0.5rem;
}
</style>
