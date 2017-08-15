import { Component, Input, OnInit } from '@angular/core'
import {Driver} from './driver'

@Component({
    selector: 'drivers-list',
    template: '<driver *ngFor="let driver of drivers" [driver]="driver"></driver>'
})
export class DriverListComponent implements OnInit {
    @Input() drivers: Driver[]

    ngOnInit() {
        console.log(this.drivers)
    }
}