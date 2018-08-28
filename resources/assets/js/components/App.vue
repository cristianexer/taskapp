<template>
    <div class="container">
        <div v-if="getAuthUser === null" class="col-12">
            <h1 class="my-3">Hey mate 👋🏽 </h1>
            <h2 class="my-3">I am your new friend who will help you to organize your tasks.</h2>
            <hr>
        </div>
        <div v-else class="col-12 mx-auto my-3">
            <hr>
            <h2 class="text-center">Hello, {{ getAuthUser }} 👋🏽</h2>
            <hr>
        </div>
        <transition name="fade">
            <router-view v-if="show"></router-view>
        </transition>
        <div class="row my-5">

            <div class="col-12 my-2 footer text-center">
            <hr>
            <div class="row">

                <div class="col mx-auto">
                    <a href="https://mugscript.wordpress.com" target="_blank"><font-awesome-icon :icon="['fab', 'wordpress']" /></a>
                </div>
                <div class="col mx-auto">
                    <a href="https://github.com/cristianexer" target="_blank"><font-awesome-icon :icon="['fab', 'github']" /></a>
                </div>
                <div class="col mx-auto">
                    <a href="https://www.linkedin.com/in/cristianexer" target="_blank"><font-awesome-icon :icon="['fab', 'linkedin']" /></a>
                </div>
                <div class="col mx-auto">
                    <a href="https://www.twitter.com/cristianexer" target="_blank"><font-awesome-icon :icon="['fab', 'twitter']" /></a>
                </div>
                <div class="col mx-auto">
                    <a href="https://www.instagram.com/cristianexer" target="_blank"><font-awesome-icon :icon="['fab', 'instagram']" /></a>
                </div>
                <div class="col-12 text-center my-2">
                    <h1>@cristianexer</h1>
                </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                show: true
            }
        },
        computed: {

            getAuthUser: function () {
                return window.Laravel.user;
            }

        }



    }

</script>
