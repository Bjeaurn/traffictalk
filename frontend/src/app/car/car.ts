import { Driver } from "./drivers/driver"

export const CAR_URL_ID = "kenteken"
export const CAR_TYPE: string = "car"

export class Car {
    readonly type: string = CAR_TYPE
    public drivers: Driver[] = []
    readonly merk: string
    readonly kleur: string

    constructor(readonly id: string, readonly name: string, readonly displayKenteken: string) {
    }
}