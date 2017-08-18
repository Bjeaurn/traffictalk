import {NgModule} from '@angular/core'
import {CommonModule} from '@angular/common'
import {RouterModule} from '@angular/router'
import {AlertModule} from 'ngx-bootstrap'
import {AlertsComponent} from './alerts/alerts.component'
import {AlertsService} from './alerts.service'
import { UserService } from "app/shared/user.service"

@NgModule({
  declarations: [
      AlertsComponent
  ],
  imports: [
    CommonModule,
    RouterModule,
    AlertModule.forRoot()
  ],
  exports: [
    CommonModule,
    AlertModule,
    AlertsComponent,
    RouterModule
  ],
  providers: [
      AlertsService,
      UserService
  ]
})
export class SharedModule { }