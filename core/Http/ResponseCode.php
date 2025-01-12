<?php

namespace Core\Http;


enum ResponseCode: int
{
	case OK = 200;
	case CREATED = 201;
	case BAD_REQUEST = 400;
	case UNAUTHORIZED = 401;
	case FORBIDDEN = 403;
	case NOT_FOUND = 404;
	case INTERNAL_SERVER_ERROR = 500;
}
