import {Car} from '../../car/car'
import {CarService} from '../../car/car.service'
import {Router} from '@angular/router'
import {Component} from '@angular/core'

@Component({
    selector: 'app-kenteken',
    template: `
        <div>
            <input type="text" name="Kenteken" #input (input)="input.value=$event.target.value.toUpperCase()" (keyup.enter)="findCar(input.value)" autocomplete="off" />
        </div>
    `,
    styles: [
        `input { padding: 10px; background: #FFCE00; border: 1px solid black; border-radius: 5px; border-left: 50px solid #0052A5; font-size: 2em; font-color: black; font-weight: bold; width: 260px; text-align: center; }`
    ]
})
export class KentekenComponent {

    private car: Car

    constructor(private router: Router, private carService: CarService) {
    }

    findCar(kenteken: string) {
        const car = this.carService.getByKenteken(kenteken)
            .subscribe(
                car => this.car = car, 
                (err) => {},
                () => {
                    this.router.navigate(['car', this.car.kenteken])
                }
            )
    }
}