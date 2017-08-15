import { Injectable } from '@angular/core'
import { Http, RequestOptions, RequestOptionsArgs, Response, XHRBackend } from '@angular/http'
import { Observable } from 'rxjs/Observable'

@Injectable()
export class HttpClient extends Http {
    constructor(backend: XHRBackend, options: RequestOptions) {
        // options.headers.append('header-name', 'header-value')
        super(backend, options)
    }

    get(url: string, options?: RequestOptionsArgs): Observable<Response> {
        return super.get(url, options)
    }
}

export function handleErrors(err: Response, caught: Observable<Response>): Observable<Response> {
    if(err.ok === false && err.status) {
        throw caught
    }
    return caught
}