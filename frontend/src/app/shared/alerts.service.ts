import {Injectable} from '@angular/core'
import {Subject} from 'rxjs'
import {HttpClient} from './http.client'

export type Alert = {
    title: string
    type?: AlertType
    timeout?: number
}

export type AlertType = "danger" | "info" | "success" | "warning"

@Injectable()
export class AlertsService {
    private alertsSubject: Subject<Alert[]> = new Subject<Alert[]>()
    constructor(private http: HttpClient) {}

    private alerts: Alert[] = []
    alert(title: string, type?: AlertType, timeout?: number) {
        let alert = <Alert>{
            title: title,
        }
        if(type) {
            alert.type = type
        } else {
            alert.type = "info"
        }

        if(timeout) {
            alert.timeout = timeout
        }
        this.alerts.push(alert)
        this.alertsSubject.next(this.alerts)
    }

    getAlerts() {
        return this.alertsSubject.asObservable()
    }
}