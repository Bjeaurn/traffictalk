import {Component} from '@angular/core'
import {AlertsService, Alert} from '../alerts.service'
import {Observable} from 'rxjs'

@Component({
    selector: 'app-alerts',
    templateUrl: './alerts.html'
})
export class AlertsComponent {

    private alerts: Observable<Alert[]>

    constructor(private alertsService: AlertsService) {
        this.alerts = this.alertsService.getAlerts()
    }
}