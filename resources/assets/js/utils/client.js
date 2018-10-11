import axios from 'axios'

export default () => {
    // __API__ = http://api.service.com
    return axios.create({baseUrl: 'http://10.0.1.16/iStore_v3'})
}