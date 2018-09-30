import 'whatwg-fetch'

export const baseUrl = 'http://' + window.location.hostname + ':' + window.location.port + '/'
// export const baseUrl = 'http://' + window.location.hostname + ':93/'

export function fetchProjectList() {
    return fetch(baseUrl + 'api/agencies/0/projects').then(res => res.json());
}

export function fetchProjectDetail(projectId) {
    return fetch(baseUrl + `api/projects/${projectId}`).then(res => res.json());
}

export function fetchAgency() {
    return fetch(baseUrl  + `api/agencies/0`).then(res => res.json());
}

export function fetchContact() {
    return fetch(baseUrl + 'api/agencies/0/associates').then(res => res.json());
}

export function fetchSocial() {
    return fetch(baseUrl + 'api/agencies/0/social').then(res => res.json());
}
