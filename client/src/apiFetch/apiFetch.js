import 'whatwg-fetch'

export const baseUrl = 'http://localhost:93/'

export function fetchProjectList() {
    return fetch(baseUrl + 'api/agencies/0/projects').then(res => res.json());
}

export function fetchProjectDetail(projectId) {
    return fetch(baseUrl + `api/projects/${projectId}`).then(res => res.json());
}

export function fetchAgency() {
    return fetch(baseUrl  + `api`).then(res => res.json());
}

export function fetchContact() {
    return fetch(baseUrl + 'api/agencies/0/associates').then(res => res.json());
}
