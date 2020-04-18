new Vue({
    el: '#article',
    data: {
        articles: [],
        i: 0,
    },
    methods: {
        sortArticles: function (objects) {
            let sorted = Object.values(objects).sort(function (a, b) {
                return new Date (b.date) - new Date(a.date);
            });
            const months = ["January", "February", "March","April", "May", "June", "July", "August", "September", "October", "November", "December"];
            sorted.forEach(formatDate);

            function formatDate(item, index, arr) {
                let d = new Date(arr[index].date);
                arr[index].date = months[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear() + " - " + addZero(d.getHours()) + ":" + addZero(d.getMinutes());
                arr[index].description = arr[index].description.substring(0, 300);
            }
            function addZero(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }

            this.articles = sorted;
            this.article = this.articles[this.i];
        },
        indexUp: function () {
            if (this.i < this.articles.length - 1) {
                this.i++;
                gsap.from(".article-animation", {duration: 0.7, opacity: 0.3});
            }
            else {
                this.i = 0;
                gsap.from(".article-animation", {duration: 0.7, opacity: 0.3});
            }
        },
        indexDown: function () {
            if (this.i > 0) {
                this.i--;
                gsap.from(".article-animation", {duration: 0.7, opacity: 0.3});
            }
            else {
                this.i = this.articles.length - 1;
                gsap.from(".article-animation", {duration: 0.7, opacity: 0.3});
            }
        },
    },
    computed: {
        article: function () {
            if (this.articles.length < 0)
                return undefined;
            return this.articles[this.i];
        }
    },
    mounted() {
        axios.get('/all-articles').then(response => this.sortArticles(response.data));
    }
});


