import { UserService } from '../shared/user.service'
import {Component} from '@angular/core'
import {Router, ActivatedRoute} from '@angular/router'
import {Observable} from 'rxjs/Observable'
import {CAR_URL_ID, Car} from './car'
import { CarService } from "app/car/car.service"
import { Subscription } from "rxjs/Subscription"

@Component({
    selector: 'app-car',
    templateUrl: './car.html',
    styles: [
        `.kenteken { padding: 10px; background: #FFCE00; border: 1px solid black; border-radius: 5px; border-left: 50px solid #0052A5; font-size: 2em; font-color: black; font-weight: bold; width: 260px; text-align: center; }`
    ]
})
export class CarComponent {
    private carObs: Observable<Car>
    public car: Car

    constructor(private activatedRoute: ActivatedRoute, private carService: CarService, private userService: UserService) {
        this.carObs = this.carService.getByKenteken(this.activatedRoute.snapshot.params[CAR_URL_ID])
        this.carObs.first().subscribe(
            (c) => this.car = c
        )
    }
}