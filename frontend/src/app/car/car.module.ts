import { NgModule } from '@angular/core'
import { Routes, RouterModule } from '@angular/router'
import { DriverListComponent } from './drivers/drivers-list.component'
import { DriverComponent } from './drivers/driver.component'
import { SharedModule } from '../shared/shared.module'
import { CarComponent } from './car.component'
import { CarService, MockCarService } from './car.service'

const carRoutes: Routes = [
    { path: 'car/:id', component: CarComponent },
]

@NgModule({
    declarations: [
        CarComponent,
        DriverListComponent,
        DriverComponent
    ],
    imports: [
        SharedModule,
        RouterModule.forRoot(carRoutes)
    ],
    exports: [],
    providers: [
        { provide: CarService, useClass: CarService }
    ]
})
export class CarModule {}