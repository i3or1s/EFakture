<?php

namespace i3or1s\EFakture\Model;

enum CirInvoiceStatus
{
    case None;
    case ActiveCir;
    case InvalidCir;
    case CancelledCir;
    case PartiallySettled;
    case Settled;
    case Assigned;
    case Proinvoice;
}
