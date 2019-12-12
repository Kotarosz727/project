<template> 
  <div>
       <!-- <ul v-for="(category,index) of categories" :key="index">
         <a :href="url+category.id">{{category.type}}</a>
     </ul>
      <b-button variant="danger">Button</b-button> -->

  <b-navbar toggleable="lg" type="dark" variant="dark">
    <b-navbar-brand href="/">本棚</b-navbar-brand>
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">

        <b-nav-item-dropdown text="カテゴリー" right>
        <b v-for="(category,index) of categories" :key="index">
          <b-dropdown-item :href="url+category.id">{{category.type}}</b-dropdown-item>
        </b>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template v-slot:button-content>
            <em>メニュー</em>
          </template>
          <b-dropdown-item href="/book/create">新規作成</b-dropdown-item>
          <!-- <b-dropdown-item href="#">Sign Out</b-dropdown-item> -->
        </b-nav-item-dropdown>
      </b-navbar-nav>
  </b-navbar>
</div>
</template>
<script>
 
    export default {
        props:["categories"],
        mounted () {
        
        },
        data(){
            return{url:"/book/category/"}
        }
    }

</script>



