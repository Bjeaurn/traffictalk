import { Injectable } from '@angular/core'
import { Observable } from 'rxjs/Observable'
import { HttpClient } from '@angular/common/http'
import { UrlBuilder } from '../shared/urlbuilder'

import { baseUrl } from '../../config'
import { Car } from './car'
import { Driver } from './drivers/driver'

interface ICarService {
    getByKenteken(kenteken: string): Observable<Car>
}

export const car = baseUrl+'car/:kenteken'

@Injectable()
export class CarService implements ICarService {
    
    constructor(private http: HttpClient) {}

    getByKenteken(kenteken: string): Observable<Car> {
        const url = UrlBuilder.fromPattern(car).withParameter("kenteken", kenteken).build()
        return this.http.get<Car>(url)
    }
}

@Injectable()
export class MockCarService implements ICarService {
    
    getByKenteken(kenteken: string): Observable<Car> {
        const result = new Car(kenteken, "Kia Picanto", "7-KSL-16")
        result.drivers = [new Driver("abcd", "Bjorn Schijff")]
        return Observable.of(result)
    }
}