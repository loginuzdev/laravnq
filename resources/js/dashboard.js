import './bootstrap';
import Alpine from 'alpinejs';


Alpine.data("__states", (params, url) => ({
    async init() {
        window.document.title = "Dashboard Ni";
        await this.getQuotes(`${url}/api/quotes?p=${this.current_page}`);
        // noinspection JSUnresolvedReference
        this.$watch('current_page', async (v) => {
            await this.getQuotes(`${url}/api/quotes?p=${this.current_page}`);
        });

    },
    is_loading: true,
    async getQuotes(uri) {
        this.rows = [];
        this.is_loading = true;
        try {
            const call = await axios(uri);
            const d = call.data;
            if (d.ok) {
                this.rows = d.data.rows;
                this.pages = d.data.pages;
                this.count = d.data.count;
            } else {
                this.error = d.error
            }
        } catch (e) {
            this.error = e.message;
        }
        this.is_loading = false;

    },
    error: "",
    pages: [],
    count: 0,
    current_page: '1',
    rows: [],
    state:
    params
}))
;


Alpine.start()
