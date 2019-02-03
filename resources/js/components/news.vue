<template>
    <div class="container">
        <div class="row justify-content-center">

            <h1 class="col-12 text-center">TVNet News</h1>

            <div class="input-group input-group-sm mb-3 col-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
                </div>
                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" @keyup.enter="getNews" v-model="search">
            </div>

            <div class="col-md-10 pb-3" v-for="anew in news">
                <div class="card card-default">
                    <div class="card-header">
                        <a href="/home?title=">
                            {{anew.title}}
                        </a>
                    </div>

                    <div class="card-body">
                        {{anew.description}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                news: [],
                search: ''
            }
        },
        mounted() {
            this.getNews();
        },
        methods: {
            getNews: function() {
                axios.post('news/get', {search: this.search}).then((news) => {
                    this.news = news.data;
                });
            }
        }
    }
</script>
