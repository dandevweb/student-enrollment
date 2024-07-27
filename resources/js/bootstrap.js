import axios from 'axios';

import Sortablejs from 'sortablejs';

window.axios = axios;
window.Sortablejs = Sortablejs;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
