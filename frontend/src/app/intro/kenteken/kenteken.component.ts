import {Car} from '../../car/car'
import {CarService} from '../../car/car.service'
import {Router} from '@angular/router'
import {Component} from '@angular/core'

const leads: string[] = [
    'Kapot achterlicht gezien?',
    'Iemand bedanken voor net rijgedrag?',
    'Interessant iemand achter het stuur gezien?'
]

@Component({
    selector: 'app-kenteken',
    templateUrl: './kenteken.html',
    styles: [
        `input { padding: 10px; background: #FFCE00; border: 1px solid black; border-radius: 5px; border-left: 50px solid #0052A5; font-size: 2em; font-color: black; font-weight: bold; width: 260px; text-align: center; }`,
        `input::placeholder { color: rgba(0,0,0,0.4); font-weight: normal; }`
    ]
})
export class KentekenComponent {

    private car: Car
    public lead: string = leads[Math.floor(Math.random() * leads.length)]

    constructor(private router: Router, private carService: CarService) {
    }

    findCar(kenteken: string) {
        const car = this.carService.getByKenteken(kenteken)
            .subscribe(
                car => this.car = car, 
                (err) => {},
                () => {
                    this.router.navigate(['car', this.car.displayKenteken])
                }
            )
    }
}