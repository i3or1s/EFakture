<?php

namespace Boris\EFakture\Model;

enum DocumentDirection: string
{
    case INBOUND = 'Inbound';
    case OUTBOUND = 'Outbound';
}
