import './bootstrap';
import Alpine from 'alpinejs';


Alpine.data("__states", (params, url) => ({
    quoteObject: params,
    auth_form: {
        username: "",
        password: "",
        error: "",
    },
    async auth() {
        this.auth_form.error = "";
        try {
            const call = await axios.post(`${url}/api/auth`, {
                "username": this.auth_form.username,
                "password": this.auth_form.password
            });
            const d = call.data;
            if(d.ok){
                window.location.href = `${url}/dashboard`;
            }else{
                this.auth_form.error = d.error;
            }
        } catch (e) {
            this.auth_form.error = e.message;
        }
    },
    modal_open: false,
    error: "",
    async getNewOne() {
        if (this.is_loading) {
            return;
        }
        this.is_loading = true;
        try {
            const call = await axios.get(`${url}/api/refresh?id=${this.quoteObject.id}`);
            const d = await call.data;
            // noinspection JSUnresolvedReference
            if (d.vn_id === 696969) {
                this.error = d.quote;
                this.is_loading = false;
                return;
            }
            this.quoteObject = call.data;
            this.error = "";
        } catch (e) {
            this.error = `${e.message}`;
        }

        this.is_loading = false;

    },
    initMe: false,
    init() {
        setTimeout(() => {
            this.initMe = true;
        }, 500);
    },
    is_loading: false,

}));
Alpine.start()
