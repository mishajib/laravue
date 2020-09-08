<template>
    <div>
        <h1>Vue SPA</h1>
        <p>
            <router-link :to="{ name: 'home' }">Home</router-link>
            <router-link :to="{ name: 'about' }">About</router-link>
            <router-link :to="{ name: 'users.index' }">Users</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
import "vuejs-noty/dist/vuejs-noty.css";
import Swal from "sweetalert2";
export default {
    name: "App"
};
</script>
