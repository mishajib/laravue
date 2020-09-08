<template>
    <div class="users">
        <div class="loading" v-if="loading">Loading...</div>
        <div v-if="error" class="error">
            {{ error }}
            <p>
                <button @click.prevent="fetchData">Try Again</button>
            </p>
        </div>
        <ul v-if="users">
            <button @click.prevent="reload">Refresh</button>
            <li v-for="({ name, email }, index) in users" :key="index">
                <strong>Name:</strong>
                {{ name }},
                <strong>Email:</strong>
                {{ email }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
    name: "UserIndex",
    data() {
        return {
            loading: false,
            users: null,
            error: null
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.users = null;
            this.loading = true;
            this.$Progress.start();
            axios
                .get("/api/users")
                .then(response => {
                    this.loading = false;
                    this.users = response.data;
                    this.$Progress.finish();
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                    this.$Progress.fail();
                });
        },
        reload() {
            this.fetchData();
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                }
            });
            Toast.fire({
                icon: "success",
                title: "Reload Successful"
            });
        }
    }
};
</script>
