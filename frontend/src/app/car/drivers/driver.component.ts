import {Component, Input, OnInit} from '@angular/core'
import {Driver} from './driver'

@Component({
    selector: 'driver',
    template: `{{ driver | json }}`
})
export class DriverComponent implements OnInit {
    @Input() driver: Driver

    ngOnInit() {
        console.log(this.driver)
    }
}