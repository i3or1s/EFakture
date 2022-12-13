<?php

namespace i3or1s\EFakture\Model;

enum DocumentDirection: string
{
    case INBOUND = 'Inbound';
    case OUTBOUND = 'Outbound';
}
