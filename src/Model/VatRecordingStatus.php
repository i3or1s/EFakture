<?php

namespace i3or1s\EFakture\Model;

enum VatRecordingStatus: string
{
    case DRAFT = 'Draft';
    case SENT = 'Sent';
}
